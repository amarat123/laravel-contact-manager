<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;
use XMLReader;


class ContactController extends Controller
{
    public function index(Request $request)
    {
        // Get the 'per_page' value from request, default to 10
        $perPage = $request->input('per_page', 10);

        // Fetch contacts with pagination
        $contacts = Contact::paginate($perPage);
        return view('contacts.index', compact('contacts', 'perPage'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:contacts,phone',
        ]);

        Contact::create($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully!');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:contacts,phone,' . $contact->id,
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully!');
    }

    public function showImportForm()
    {
        return view('contacts.import');
    }

    public function import(Request $request)
    {
        $file = $request->file('xml_file');

        if (!$file) {
            return back()->with('error', 'Please upload an XML file.');
        }

        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 300);

        DB::disableQueryLog();

        $reader = new XMLReader();
        $reader->open($file->getPathname());

        $batch = [];
        DB::beginTransaction();

        try {
            while ($reader->read()) {
                if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == 'contact') {
                    $xml = new SimpleXMLElement($reader->readOuterXML());

                    $batch[] = [
                        'name' => (string) $xml->name,
                        'phone' => (string) $xml->phone,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if (count($batch) >= 5000) {
                        Contact::insert($batch);
                        $batch = [];
                    }
                }
            }

            if (!empty($batch)) {
                Contact::insert($batch);
            }

            DB::commit();
            $reader->close();

            return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }


}

