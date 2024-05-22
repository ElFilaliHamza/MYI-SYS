
<div>
        <div>
            
            <form wire:submit.prevent="save">
                
                <div>
                    <label for="companyName">Company Name:</label>
                    <input type="text" wire:model.defer="companyName" id="companyName">
                    @error('companyName') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="category">Category:</label>
                    <input type="text" wire:model.defer="category" id="category">
                    @error('category') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="agencyName">Agency Name:</label>
                    <input type="text" wire:model.defer="agencyName" id="agencyName">
                    @error('agencyName') <span>{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="firstName">First Name:</label>
                    <input type="text" wire:model.defer="firstName" id="firstName">
                    @error('firstName') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="lastName">Last Name:</label>
                    <input type="text" wire:model.defer="lastName" id="lastName">
                    @error('lastName') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="gender">Gender:</label>
                    <select wire:model.defer="gender" id="gender">
                        <option value="">Select</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    @error('gender') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" wire:model.defer="email" id="email">
                    @error('email') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" wire:model.defer="phoneNumber" id="phoneNumber">
                    @error('phoneNumber') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="address1">Address 1:</label>
                    <input type="text" wire:model.defer="address1" id="address1">
                    @error('address1') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="address2">Address 2:</label>
                    <input type="text" wire:model.defer="address2" id="address2">
                    @error('address2') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="city">City:</label>
                    <input type="text" wire:model.defer="city" id="city">
                    @error('city') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="state">State:</label>
                    <input type="text" wire:model.defer="state" id="state">
                    @error('state') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="zip">Zip:</label>
                    <input type="text" wire:model.defer="zip" id="zip">
                    @error('zip') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="country">Country:</label>
                    <input type="text" wire:model.defer="country" id="country">
                    @error('country') <span>{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="comments">Comments:</label>
                    <textarea wire:model.defer="comments" id="comments"></textarea>
                    @error('comments') <span>{{ $message }}</span> @enderror
                </div>

                
                <div>
                    <label for="accountNumber">Account Number:</label>
                    <input type="text" wire:model.defer="accountNumber" id="accountNumber">
                    @error('accountNumber') <span>{{ $message }}</span> @enderror
                </div>

                <button type="submit">Create supplier</button>
                <button wire:click="$set('modalMode', '')">Annuler</button>
            </form>
        </div>

        <div>
        <h2>All Suppliers</h2>
        <table>
            <thead>
                <tr>
                    <th>Identifier</th>
                    <th>Agency Name</th>
                    <th>Company Name</th>
                    <th>Category</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->agency_name }}</td>
                    <td>{{ $supplier->company_name }}</td>
                    <td>{{ $supplier->category }}</td>
                    <td>{{ $supplier->people->last_name }}</td>
                    <td>{{ $supplier->people->first_name }}</td>
                    <td>{{ $supplier->people->email }}</td>
                    <td>{{ $supplier->people->phone_number }}</td>
                    <td>
                        <button wire:click="editSupplier({{ $supplier->id }})">Edit</button>
                        <button wire:click="deleteSupplier({{ $supplier->id }})">Delete</button>
                    </td> 
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($selectedSupplierId)
    <form wire:submit.prevent="updateSupplier">
        <!-- Update form fields -->
        <div>
            <label for="companyName">Company Name:</label>
            <input type="text" wire:model.defer="companyName" id="companyName">
            @error('companyName') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" wire:model.defer="category" id="category">
            @error('category') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="agencyName">Agency Name:</label>
            <input type="text" wire:model.defer="agencyName" id="agencyName">
            @error('agencyName') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="firstName">First Name:</label>
            <input type="text" wire:model.defer="firstName" id="firstName">
            @error('firstName') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" wire:model.defer="lastName" id="lastName">
            @error('lastName') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="gender">Gender:</label>
            <select wire:model.defer="gender" id="gender">
                <option value="">Select</option>
                <option value="0">Male</option>
                <option value="1">Female</option>
            </select>
            @error('gender') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" wire:model.defer="email" id="email">
            @error('email') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" wire:model.defer="phoneNumber" id="phoneNumber">
            @error('phoneNumber') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="address1">Address 1:</label>
            <input type="text" wire:model.defer="address1" id="address1">
            @error('address1') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="address2">Address 2:</label>
            <input type="text" wire:model.defer="address2" id="address2">
            @error('address2') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="city">City:</label>
            <input type="text" wire:model.defer="city" id="city">
            @error('city') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="state">State:</label>
            <input type="text" wire:model.defer="state" id="state">
            @error('state') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="zip">Zip:</label>
            <input type="text" wire:model.defer="zip" id="zip">
            @error('zip') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="country">Country:</label>
            <input type="text" wire:model.defer="country" id="country">
            @error('country') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="comments">Comments:</label>
            <textarea wire:model.defer="comments" id="comments"></textarea>
            @error('comments') <span>{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="accountNumber">Account Number:</label>
            <input type="text" wire:model.defer="accountNumber" id="accountNumber">
            @error('accountNumber') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">Update Supplier</button>
        <button wire:click="editSupplier(null)">Cancel</button>
    </form>
@endif

    </div>
    
</div>




