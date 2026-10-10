<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Generic CRUD for the simple content tables. Child classes declare the
 * model, the route/view slug, a label and the field list.
 */
abstract class ContentController extends Controller
{
    abstract protected function model(): string;

    abstract protected function slug(): string;

    abstract protected function label(): string;

    /** @return array<string, array{label:string,type:string,rules:string,options?:array}> */
    abstract protected function fields(): array;

    public function index()
    {
        return view('admin.content.index', [
            'items' => ($this->model())::orderBy('sort_order')->orderBy('id')->get(),
            'slug' => $this->slug(), 'label' => $this->label(), 'fields' => $this->fields(),
        ]);
    }

    public function create()
    {
        return $this->form(new ($this->model()));
    }

    public function edit(int $id)
    {
        return $this->form(($this->model())::findOrFail($id));
    }

    public function store(Request $request)
    {
        ($this->model())::create($this->payload($request));

        return redirect()->route("admin.{$this->slug()}.index")->with('status', 'Saved.');
    }

    public function update(Request $request, int $id)
    {
        $item = ($this->model())::findOrFail($id);
        $item->update($this->payload($request, $item));

        return redirect()->route("admin.{$this->slug()}.index")->with('status', 'Saved.');
    }

    public function destroy(int $id)
    {
        $item = ($this->model())::findOrFail($id);
        foreach ($this->fields() as $name => $f) {
            if ($f['type'] === 'image' && $item->$name) {
                Storage::disk('public')->delete($item->$name);
            }
        }
        $item->delete();

        return back()->with('status', 'Deleted.');
    }

    private function form($item)
    {
        return view('admin.content.form', [
            'item' => $item, 'slug' => $this->slug(), 'label' => $this->label(), 'fields' => $this->fields(),
        ]);
    }

    private function payload(Request $request, $item = null): array
    {
        $rules = collect($this->fields())->map(fn ($f) => $f['rules'])->all();
        $data = $request->validate($rules);

        foreach ($this->fields() as $name => $f) {
            if ($f['type'] !== 'image') {
                continue;
            }
            unset($data[$name]);
            if ($request->hasFile($name)) {
                if ($item?->$name) {
                    Storage::disk('public')->delete($item->$name);
                }
                $data[$name] = $request->file($name)->store($this->slug(), 'public');
            }
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }
}
