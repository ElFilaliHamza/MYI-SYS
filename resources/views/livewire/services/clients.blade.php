<!-- resources/views/livewire/services/customer/create.blade.php -->

<div>
    <form wire:submit.prevent="create">
        <div>
            <label for="first_name">Prénom:</label>
            <input type="text" wire:model="firstName">
        </div>
        <div>
            <label for="last_name">Nom de famille:</label>
            <input type="text" wire:model="lastName">
            @error('lastName')
                <span>{{ $message }}</span>
            @enderror

        </div>
        <div>
            <label for="gender">Genre:</label>
            <select wire:model="gender">
                <option value="1">Masculin</option>
                <option value="0">Féminin</option>
            </select>
        </div>
        <div>
            <label for="phone_number">Téléphone:</label>
            <input type="text" wire:model="phoneNumber">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" wire:model="email">
        </div>
        <div>
            <label for="address1">Adresse 1:</label>
            <input type="text" wire:model="address1">
        </div>
        <div>
            <label for="address2">Adresse 2:</label>
            <input type="text" wire:model="address2">
        </div>
        <div>
            <label for="city">Ville:</label>
            <input type="text" wire:model="city">
        </div>
        <div>
            <label for="zip">Code postal:</label>
            <input type="text" wire:model="zip">
        </div>
        <div>
            <label for="country">Pays:</label>
            <input type="text" wire:model="country">
        </div>
        <div>
            <label for="comments">Commentaires:</label>
            <textarea wire:model="comments"></textarea>
        </div>
        <div>
            <label for="companyName">Nom de l'entreprise:</label>
            <input type="text" wire:model="companyName">
        </div>
        <div>
            <label for="points">points:</label>
            <input type="text" wire:model="points">
        </div>
        <div>
            <label for="accountNumber">Numéro de compte:</label>
            <input type="text" wire:model="accountNumber">
        </div>
        <input type="text" name="user_name" wire:model="userName" readonly>
        <input type="text" name="userId" wire:model="userId" readonly>

        <button type="submit">Créer Client</button>
        <div>
            <label for="package">Packages:</label>
            <select wire:model="selectedPackage">
                <option value="">Sélectionnez un package</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->package_name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    @foreach ($customers as $customer)
        <p>Client: ::id: {{ $customer->customer_id }}{{ $customer->company_name }} - {{ $customer->account_number }}
            deleted: {{ $customer->deleted }}{{ $customer->person->first_name }} {{ $customer->person->last_name }}
            {{ $customer->person->phonenumber }} {{ $customer->person->email }}</p>
        <button wire:click="destroy({{ $customer->customer_id }})">Supprimer</button>


        <!-- Ajoutez d'autres données de personne ici si nécessaire -->
    @endforeach
</div>
<!-- Ajoutez d'autres données de personne ici si nécessaire -->
@endforeach
</div>
