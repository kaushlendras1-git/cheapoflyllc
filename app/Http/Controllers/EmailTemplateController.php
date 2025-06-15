<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $email_templates = EmailTemplate::paginate(10); 
        return view('web.email_template.index', compact('email_templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('web.email_template.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        try {
            // Create a new email template
            EmailTemplate::create([
                'name' => $validatedData['name'],
                'subject' => $validatedData['subject'],
                'content' => $validatedData['content'],
            ]);
    
            // Redirect to the email.index route with a success message
            return redirect()->route('emails.index')->with('success', 'Email template created successfully.');
    
        } catch (\Exception $e) {
            // Handle any errors and redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create email template.');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        // try {
            $emailTemplate = EmailTemplate::findOrFail($id);
            return view('web.email_template.edit', compact('emailTemplate'));
        // } catch (\Exception $e) {
        //     return redirect()->route('emails.index')->with('error', 'Email template not found.');
        // }
    }


    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
         
            $emailTemplate = EmailTemplate::findOrFail($id);
            $emailTemplate->update($validatedData);

            return redirect()->route('emails.index')->with('success', 'Email template updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update email template.');
        }
    }


   
    public function destroy(string $id)
    {
        try {
            $emailTemplate = EmailTemplate::findOrFail($id);
            $emailTemplate->delete();
            return redirect()->route('emails.index')->with('success', 'Email template deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete email template.');
        }
    }

}
