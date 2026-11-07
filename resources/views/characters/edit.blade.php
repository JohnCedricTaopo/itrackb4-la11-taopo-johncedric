@extends('layouts.app')

@section('title', 'Edit Character')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-4">
                <p class="text-uppercase text-primary fw-semibold small mb-1">Character archive</p>
                <h2 class="mb-1">Edit Character</h2>
                <p class="text-muted mb-0">Update the information for {{ $character->name }}.</p>
            </div>

            <form action="{{ route('characters.update', $character) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Character Name</label>
                    <input
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        name="name"
                        id="name"
                        value="{{ old('name', $character->name) }}"
                    >
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="element_id" class="form-label">Element</label>
                    <select
                        class="form-select @error('element_id') is-invalid @enderror"
                        name="element_id"
                        id="element_id"
                    >
                        <option value="">Choose an element</option>
                        @foreach ($elements as $element)
                            <option
                                value="{{ $element->id }}"
                                @selected(old('element_id', $character->element_id) == $element->id)
                            >
                                {{ $element->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('element_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="weapon" class="form-label">Weapon</label>
                    <select
                        class="form-select @error('weapon') is-invalid @enderror"
                        name="weapon"
                        id="weapon"
                    >
                        <option value="">Choose a weapon</option>
                        @foreach (['Sword', 'Claymore', 'Polearm', 'Catalyst', 'Bow'] as $weapon)
                            <option
                                value="{{ $weapon }}"
                                @selected(old('weapon', $character->weapon) === $weapon)
                            >
                                {{ $weapon }}
                            </option>
                        @endforeach
                    </select>
                    @error('weapon')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rarity" class="form-label">Rarity</label>
                    <select
                        class="form-select @error('rarity') is-invalid @enderror"
                        name="rarity"
                        id="rarity"
                    >
                        <option value="">Choose a rarity</option>
                        @foreach ([4, 5] as $rarity)
                            <option
                                value="{{ $rarity }}"
                                @selected(old('rarity', $character->rarity) == $rarity)
                            >
                                {{ $rarity }}-Star
                            </option>
                        @endforeach
                    </select>
                    @error('rarity')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="is_playable" class="form-label">Playable</label>
                    <select
                        class="form-select @error('is_playable') is-invalid @enderror"
                        name="is_playable"
                        id="is_playable"
                    >
                        <option value="">Choose an option</option>
                        <option value="1" @selected((string) old('is_playable', $character->is_playable ? '1' : '0') === '1')>
                            Yes
                        </option>
                        <option value="0" @selected((string) old('is_playable', $character->is_playable ? '1' : '0') === '0')>
                            No
                        </option>
                    </select>
                    @error('is_playable')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea
                        class="form-control @error('remarks') is-invalid @enderror"
                        name="remarks"
                        id="remarks"
                        rows="3"
                    >{{ old('remarks', $character->remarks) }}</textarea>
                    @error('remarks')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Character</button>
                <a class="btn btn-outline-secondary" href="{{ route('characters.index') }}">Cancel</a>
            </form>
        </div>
    </div>
@endsection