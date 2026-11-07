@extends('layouts.app')

@section('title', 'All Characters')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div>
                    <p class="text-uppercase text-primary fw-semibold small mb-1">
                        Genshin Impact collection
                    </p>

                    <h2 class="mb-1">Character Archive</h2>

                    <p class="text-muted mb-0">
                        Select a character name to open its individual page.
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a
                        class="btn btn-success"
                        href="{{ route('characters.create') }}"
                    >
                        Add character
                    </a>

                    <a
                        class="btn btn-primary"
                        href="{{ route('characters.featured') }}"
                    >
                        View featured
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="alert alert-info">
                <strong>Active filters:</strong>
                Element:
                {{ $element === 'all' ? 'All elements' : $element }}
                |
                Rarity:
                {{ $rarity === 'all' ? 'All rarities' : $rarity . '-Star' }}
            </div>

            <div class="mb-4">
                <h5>Filter by element</h5>

                <div class="d-flex flex-wrap gap-2">
                    <a
                        class="btn btn-outline-secondary btn-sm"
                        href="{{ route('characters.index', [
                            'rarity' => $rarity !== 'all' ? $rarity : null
                        ]) }}"
                    >
                        All elements
                    </a>

                    @foreach ($elements as $elementOption)
                        <a
                            class="btn {{
                                (string) $element === (string) $elementOption->id
                                    ? 'btn-primary'
                                    : 'btn-outline-primary'
                            }} btn-sm"
                            href="{{ route('characters.index', [
                                'element' => $elementOption->id,
                                'rarity' => $rarity !== 'all' ? $rarity : null
                            ]) }}"
                        >
                            {{ $elementOption->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <h5>Filter by rarity</h5>

                <div class="d-flex flex-wrap gap-2">
                    <a
                        class="btn btn-outline-secondary btn-sm"
                        href="{{ route('characters.index', [
                            'element' => $element !== 'all' ? $element : null
                        ]) }}"
                    >
                        All rarities
                    </a>

                    @foreach ([4, 5] as $rarityOption)
                        <a
                            class="btn {{
                                (string) $rarity === (string) $rarityOption
                                    ? 'btn-warning'
                                    : 'btn-outline-warning'
                            }} btn-sm"
                            href="{{ route('characters.index', [
                                'element' => $element !== 'all' ? $element : null,
                                'rarity' => $rarityOption
                            ]) }}"
                        >
                            {{ $rarityOption }}-Star
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <a
                    class="btn btn-success btn-sm"
                    href="{{ route('characters.index') }}"
                >
                    Clear both filters
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Character Name</th>
                            <th>Element</th>
                            <th>Weapon</th>
                            <th>Rarity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($characters as $character)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $character->id }}</td>

                                <td>
                                    <a
                                        href="{{ route('characters.show', $character) }}"
                                    >
                                        {{ $character->name }}
                                    </a>
                                </td>

                                <td>
                                    {{ $character->element->name }}
                                </td>

                                <td>
                                    {{ $character->weapon }}
                                </td>

                                <td>
                                    @if ($character->rarity >= 5)
                                        <span class="badge text-bg-warning">
                                            5-Star Featured
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            {{ $character->rarity }}-Star
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a
                                        class="btn btn-warning btn-sm"
                                        href="{{ route('characters.edit', $character) }}"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('characters.destroy', $character) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Delete this character?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="7"
                                    class="text-center text-muted py-4"
                                >
                                    No characters match the selected filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
