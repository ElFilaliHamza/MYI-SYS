<div>
    <div class="card">
        <div class="card-body">
            <div class="conteneur">
                <h1 class="card-title mb-2">Encaissement</h1>
                <div class="conteneur-button">
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                        data-bs-target="#modalCreate" wire:model.live="search">
                        Ajouter encaissement
                    </button>
                </div>
            </div>
            <div class="conteneur">
                <p class="mb-30">Authenticated User: <b><code>{{ Auth::user()->name }}</code></b></p>
                <div>
                    {{-- <input class="form-control" type="text" wire:model.live='search'> --}}
                    {{-- <input class="form-control" type="text" class="form-control" type="text" wire:model.live="search"
            placeholder="Search article..." aria-label="Default" aria-describedby="inputGroup-sizing-default"> --}}
                </div>
            </div>

            {{-- @if (is_null($isOpeningCaisse)) --}}
            <div class="pb-3">
                <button class="btn btn-primary" wire:click="toggleOpeningCaisse" data-bs-toggle="modal"
                    data-bs-target="#myModal5">Open Cash Register</button>
                <button class="btn btn-primary" wire:click="toggleClosingCaisse">Close Cash Register</button>
            </div>
            {{-- @endif --}}

            @if ($isOpeningCaisse === true)
                @if (session()->has('error'))
                    <div>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                @if (
                    $yesterdaySalesTotal !== null &&
                        $yesterdayExpensesTotal !== null &&
                        $yesterdaySalesTotal == 0 &&
                        $yesterdayExpensesTotal == 0)
                    <!-- Opening Cash Register Form -->
                    <form wire:submit.prevent="openCaisse">
                        <div>
                            <label for="openAmountManual">Enter Opening Amount Manually:</label>
                            <input class="form-control" wire:model="openAmountManual" type="number"
                                id="openAmountManual" name="openAmountManual">
                            @error('openAmountManual')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="description">Description:</label>
                            <textarea class="form-control" wire:model="description" id="description" name="description"></textarea>
                            @error('description')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row justify-content-end">
                            <button class="btn btn-success col-2" type="submit">Open Cash Register</button>
                        </div>
                    </form>
                @else
                    <!-- Opening Amount Display -->
                    <div>
                        <label for="open_amount_cash">Opening Amount (Cash) for Yesterday:</label>
                        <input class="form-control" type="number" id="open_amount_cash" name="open_amount_cash"
                            readonly value="{{ $open_amount_cash }}">
                        @error('open_amount_cash')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Opening Cash Register Form -->
                    <form wire:submit.prevent="openCaisse">
                        <div>
                            <label for="transfer_amount_cash">Transfer Amount (Cash):</label>
                            <input class="form-control" wire:model="transfer_amount_cash" type="number"
                                id="transfer_amount_cash" name="transfer_amount_cash">
                            @error('transfer_amount_cash')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="note">Note:</label>
                            <textarea class="form-control" wire:model="note" id="note" name="note"></textarea>
                            @error('note')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="description">Description:</label>
                            <textarea class="form-control" wire:model="description" id="description" name="description"></textarea>
                            @error('description')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="open_user_id">Authenticated User:</label>
                            <input class="form-control" type="text" id="open_user_id" name="open_user_id"
                                value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div>
                            <button type="submit">Open Cash Register</button>
                        </div>
                    </form>
                @endif
            @endif

            @if ($isOpeningCaisse === true)
                @if (session()->has('error'))
                    <div>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
            @elseif ($isOpeningCaisse === false)
                <form wire:submit.prevent="closeCaisse">
                    <div>
                        <label for="closing_amount_total">Closing Amount (Total):</label>
                        <input style="background-color: rgba(191, 191, 191, 0.393)" class="form-control" type="number"
                            id="closing_amount_total" name="closing_amount_total" readonly
                            wire:model="closing_amount_total">
                        @error('closing_amount_cash')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">

                        <div class="col-4">
                            <label for="closing_amount_cash">Closing Amount (Cash):</label>
                            <input style="background-color: rgba(191, 191, 191, 0.393)" class="form-control"
                                type="number" id="closing_amount_cash" name="closing_amount_cash" readonly
                                wire:model="closing_amount_cash">
                            @error('closing_amount_cash')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="closing_amount_card">Closing Amount (Card):</label>
                            <input style="background-color: rgba(191, 191, 191, 0.393)" class="form-control"
                                type="number" id="closing_amount_card" name="closing_amount_card" readonly
                                wire:model="closing_amount_card">
                            @error('closing_amount_cash')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="closing_amount_check">Closing Amount (Check):</label>
                            <input style="background-color: rgba(191, 191, 191, 0.393)" class="form-control"
                                type="number" id="closing_amount_check" name="closing_amount_check" readonly
                                wire:model="closing_amount_check">
                            @error('closing_amount_cash')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                    </div>


                    <div>
                        <label for="description">Description:</label>
                        <textarea class="form-control" wire:model="description" id="description" name="description"></textarea>
                        @error('description')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="open_user_id">Authenticated User:</label>
                        <input style="background-color: rgba(191, 191, 191, 0.393)" class="form-control"
                            type="text" id="open_user_id" name="open_user_id" value="{{ Auth::user()->name }}"
                            readonly>
                    </div>
                    <div>
                        <label for="note">Note:</label>
                        <textarea class="form-control" wire:model="note" id="note" name="note"></textarea>
                        @error('note')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row justify-content-end pt-3">
                        <button class="btn btn-success col-2" type="submit">Close Cash Register</button>
                    </div>
                </form>

            @endif
        </div>
    </div>
    {{-- <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
            only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged.</p>
          <p><strong>Lorem Ipsum is simply dummy</strong> text of the printing and typesetting industry. Lorem
            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a type specimen book. It has survived not
            only five centuries, but also the leap into electronic typesetting,
            remaining essentially unchanged.</p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div> --}}
</div>
</div>
