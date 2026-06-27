<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Support\Uploads;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $testimonials = Testimonial::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where('name', 'like', '%'.$q.'%')
                    ->orWhere('role', 'like', '%'.$q.'%')
                    ->orWhere('message', 'like', '%'.$q.'%');
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.testimonials.index', [
            'testimonials' => $testimonials,
            'filters' => ['q' => $q],
        ]);
    }

    public function create(): View
    {
        return view('admin.testimonials.create', [
            'testimonial' => new Testimonial(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['avatar_path'] = Uploads::storeOne($request->file('avatar'), 'testimonials');
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        Testimonial::query()->create($data);

        return redirect()->route('admin.testimonials.index');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('admin.testimonials.edit', [
            'testimonial' => $testimonial,
        ]);
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validated($request);
        $data['is_published'] = (bool) ($data['is_published'] ?? false);

        if ($request->boolean('remove_avatar')) {
            Uploads::deleteMany([$testimonial->avatar_path]);
            $data['avatar_path'] = null;
        }

        $newAvatar = Uploads::storeOne($request->file('avatar'), 'testimonials');
        if ($newAvatar) {
            Uploads::deleteMany([$testimonial->avatar_path]);
            $data['avatar_path'] = $newAvatar;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index');
    }

    public function destroy(Testimonial $testimonial)
    {
        Uploads::deleteMany([$testimonial->avatar_path]);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'message' => ['required', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'avatar' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}

