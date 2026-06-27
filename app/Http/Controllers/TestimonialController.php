<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->where('is_published', true)
            ->latest()
            ->paginate(12);

        return view('frontend.testimonials.index', [
            'testimonials' => $testimonials,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $data['is_published'] = false;

        Testimonial::query()->create($data);

        return back()->with('success', 'Terima kasih! Testimoni Anda akan kami tinjau terlebih dahulu.');
    }
}
