<div class="container">
    <div class="row">
        <div class="card-group col-7">
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        Nytt meddelande
                    </h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="title">
                                {{ __('comment.label-title') }} <span class="text-danger"
                                    title="Obligatoriskt fält">*</span>
                            </label>
                            <input wire:model="comment.title" type="text" id="title" name="title"
                                class="form-control" placeholder="{{ __('comment.placeholder-title') }}">
                            @error('comment.title')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">
                                {{ __('comment.label-body') }} <span class="text-danger"
                                    title="Obligatoriskt fält">*</span>
                            </label>
                            <textarea wire:model="comment.body" id="body" name="body" class="form-control"
                                placeholder="{{ __('comment.placeholder-body') }}" type="date" rows="6"></textarea>
                            @error('comment.body')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="expire_at">
                                {{ __('comment.label-expire_at') }} <span class="text-danger"
                                    title="Obligatoriskt fält">*</span>
                            </label>
                            <input wire:model="comment.expire_at" id="expire_at" name="expire_at" class="form-control"
                                placeholder="{{ __('comment.placeholder-expire_at') }}" type="date"
                                min="{{ today()->addDay()->format('Y-m-d') }}" format="yyyy-mm-dd">
                            @error('comment.expire_at')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        @can('comments-pinned')
                            <div class="form-check">
                                <input wire:model="comment.pinned" type="checkbox" id="pinned" name="pinned"
                                    class="form-check-input">
                                <label for="pinned" class="form-check-label">
                                    {{ __('comment.label-pinned') }} <span class="text-danger"
                                        title="Obligatoriskt fält">*</span>
                                </label>
                                @error('comment.pinned')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endcan
                        <label>&nbsp;</label>
                        <x-form-savebutton />
                    </form>
                </div>
            </div>
        </div>
        <div class="card-group col-5">
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title">
                        Kontakt
                    </h4>
                </div>
                <div class="card-body">
                    <dl class="list-group">
                        <dt><a
                                href="mailto:ordforande@karlstadsbilkooperativ.org?subject=Bilkooperativet:%20">Ordförande</a>
                        </dt>
                        <dd>Bilkooperativet, Medlemsskap, Allmänna frågor, Hemsidan</dd>
                        <dt><a href="mailto:kassor@karlstadsbilkooperativ.org?subject=Bilkooperativet:%20">Kassör</a>
                        </dt>
                        <dd>Fakturor, Drivmedelskort, Utlägg</dd>
                        <dt><a href="mailto:bilvard@karlstadsbilkooperativ.org?subject=Bilkooperativet:%20">Bilvärd</a>
                        </dt>
                        <dd>Bilarna, Barnstolen, Förrådet, Bokningsproblem, Medlemssidorna</dd>
                        <dt><a
                                href="mailto:skadeanmalan@karlstadsbilkooperativ.org?subject=Bilkooperativet:%20Skadeanm&auml;lan">Skadeanmälan</a>
                        </dt>
                        <dd>Fel och skador på bilarna</dd>
                        <dt>Postadress</dt>
                        <dd>Karlstads Bilkooperativ<br>
                            Att: Fredrik Holm<br>
                            Box 2050<br>
                            650 02 Karlstad</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-group">
            <div class="card col-12">
                <div class="card-header">
                    <h4 class="card-title">Meddelanden</h4>
                </div>
                <div class="card-body">
                    @forelse($comments as $item)
                        <div class="card mb-2 p-1 {{ $item->pinned ? 'bg-warning' : '' }}">
                            <div class="card-body col">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title">{{ $item->title }}
                                        @if ($item->created_at > (Auth::user()->previous_login_at ?? Auth::user()->created_at))
                                            <x-icon title="Ny sedan föregående inloggning">newspaper</x-icon>
                                        @endif
                                    </h4>
                                    <span>
                                        av {{ $item->author->name ?? 'Tidigare medlem' }} @if (!empty($item->author->title))
                                            ({{ $item->author->title }})
                                        @endif
                                        <span title="{{ $item->created_at }}">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="mx-2">{!! $item->getHtmlBody() !!}</span>
                                    <div class="d-flex flex-nowrap">
                                        @if (Auth::user()->can('update', $item) || Auth::user()->id == $item->created_by)
                                            <span class="mx-2">
                                                <button wire:click="edit({{ $item->id }})" type="submit"
                                                    class="btn btn-primary">Redigera</button>
                                            </span>
                                        @endif
                                        @if (Auth::user()->can('delete', $item) || Auth::user()->id == $item->created_by)
                                            <span class="mx-2">
                                                <button wire:click="delete({{ $item->id }})" type="submit"
                                                    class="btn btn-primary">Radera</button>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h5 class="card-title">Inga kommentarer att visa just nu</h5>
                    @endforelse

                    <div class="d-flex justify-content-between">
                        {{ $comments->links() }}
                        <div><button wire:click="extend" class="btn btn-primary">Ladda ytterligare 3 månader</button><a
                                name="last"> </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
