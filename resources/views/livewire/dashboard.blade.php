<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <!-- Body Content -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-6 col-xl">
                        <!-- Card -->
                        <div class="card box-margin">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!-- Title -->
                                        <h6 class="text-uppercase font-14">
                                            Clients
                                        </h6>

                                        <!-- Heading -->
                                        <span class="font-24 text-dark mb-0">
                                            {{ $numberOfCustomers }}
                                        </span>
                                    </div>

                                    <div class="col-auto">
                                        <!-- Icon -->
                                        <div class="icon">
                                            <img src="img/bg-img/icon-12.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl">
                        <!-- Card -->
                        <div class="card box-margin">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!-- Title -->
                                        <h6 class="font-14 text-uppercase">
                                            Fournisseur
                                        </h6>
                                        <!-- Heading -->
                                        <span class="font-24 text-dark mb-0">
                                            {{ $numberOfSuppliers }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Icon -->
                                        <div class="icon">
                                            <img src="img/bg-img/icon-9.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl">
                        <!-- Card -->
                        <div class="card box-margin">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!-- Title -->
                                        <h6 class="font-14 text-uppercase">
                                            Employés
                                        </h6>
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-auto">
                                                <!-- Heading -->
                                                <span class="font-24 text-dark mb-0">
                                                    {{ $numberOfUsers }}
                                                </span>
                                            </div>
                                            <div class="col">
                                                <!-- Progress -->
                                                <!-- <div class="progress h-5">
                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <!-- Icon -->
                                        <div class="icon">
                                            <img src="img/bg-img/icon-10.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl">
                        <!-- Card -->
                        <div class="card box-margin">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <!-- Title -->
                                        <h6 class="font-14 text-uppercase">
                                            Articles en stock
                                        </h6>
                                        <!-- Heading -->
                                        <span class="font-24 text-dark">
                                            {{ $totalUniqueItems }}
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <!-- Icon -->
                                        <div class="icon">
                                            <img src="img/bg-img/icon-11.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / .row -->

                <div class="row">


                    <!-- Latest Update Area -->
                    <div class="col-lg-8 box-margin height-card">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Latest Update</h5>
                                <div class="transaction-area">
                                    <div class="d-flex flex-row list-group-item align-items-center justify-content-between">
                                        <div class="media d-flex justify-content-center align-items-center">
                                            <div class="icon-section bg-primary-soft">
                                                <i class="fa fa-file-code-o"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 font-15">New Users</h6>
                                                <p class="mb-0 font-13">6 June 19, 10:25 AM</p>
                                            </div>
                                        </div>

                                        <div class="amount txt-gray-5">
                                            <p class="mb-0">57,0000</p>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row list-group-item align-items-center justify-content-between">
                                        <div class="media d-flex justify-content-center align-items-center">
                                            <div class="icon-section bg-danger-soft">
                                                <i class="fa fa-newspaper-o"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 font-15">Page Views</h6>
                                                <p class="mb-0 font-13">9 July 19, 03:43 Pm</p>
                                            </div>
                                        </div>

                                        <div class="amount txt-gray-5">
                                            <p class="mb-0">79,496</p>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row list-group-item align-items-center justify-content-between">
                                        <div class="media d-flex justify-content-center align-items-center">
                                            <div class="icon-section bg-success-soft">
                                                <i class="fa fa-clone"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 font-15">Page Sessions</h6>
                                                <p class="mb-0 font-13">6 April 19, 02:34 PM</p>
                                            </div>
                                        </div>

                                        <div class="amount txt-gray-5">
                                            <p class="mb-0">47,381</p>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row list-group-item align-items-center justify-content-between">
                                        <div class="media d-flex justify-content-center align-items-center">
                                            <div class="icon-section bg-danger-soft">
                                                <i class="icon-wallet"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1 font-15">Click Through</h6>
                                                <p class="mb-0 font-13">22 January 19, 07:21 AM</p>
                                            </div>
                                        </div>

                                        <div class="amount txt-gray-5">
                                            <p class="mb-0">4,76,8294</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Notification Area -->
                    <div class="col-md-6 col-xl-4 box-margin height-card ">
                        <div class="card">
                            <div class="card-body">
                                <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
                                    <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="card-title mb-0">
                                                Notifications
                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-toolbar">
                                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-brand nav-tabs-bold" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_portlet_tabs_1_1_1_content" role="tab" aria-selected="true">
                                                        Week
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_portlet_tabs_1_1_3_content" role="tab" aria-selected="false">
                                                        Month
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body" id="notificationBox">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="kt_portlet_tabs_1_1_1_content" role="tabpanel">
                                                <div class="kt-scroll ps ps--active-y" data-scroll="true" data-mobile-height="350">
                                                    <!--Begin::Timeline -->
                                                    <div class="xv-timeline">
                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--success">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_mail_alt text-primary font-weight-bold"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">02:30
                                                                    PM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">Xviten
                                                                created new layout whith tens of new options for
                                                                Keen Admin panel</a>
                                                            <div class="xv-timeline__item-info">
                                                                HTML,CSS,VueJS
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--danger">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_genius font-weight-bold text-danger"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">01:20
                                                                    AM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>

                                                            <a href="" class="xv-timeline__item-text">
                                                                New secyrity alert by Firewall &amp; order to
                                                                take aktion on User Preferences
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Security, Fieewall
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--brand">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_gift_alt font-weight-bold text-success"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">Yestardey</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>

                                                            <a href="" class="xv-timeline__item-text">
                                                                FlyMore design mock-ups been uploadet by
                                                                designers Bob, Naomi, Richard
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                PSD, Sketch, AJ
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->


                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--danger">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_genius font-weight-bold text-danger"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">01:20
                                                                    AM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                New secyrity alert by Firewall &amp; order to
                                                                take aktion on User Preferences
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Security, Fieewall
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--warning">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_datareport font-weight-bold text-warning"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">Aug
                                                                    13,2019</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                Meeting with Ken Digital Corp ot Unit14, 3
                                                                Edigor Buildings, George Street, Loondon<br>
                                                                England, BA12FJ
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Meeting, Customer
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="kt_portlet_tabs_1_1_3_content" role="tabpanel">
                                                <div class="kt-scroll ps" data-scroll="true" style="height: 420px; overflow: hidden;" data-mobile-height="350">
                                                    <!--Begin::Timeline -->
                                                    <div class="xv-timeline">
                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--success">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_mail_alt text-primary font-weight-bold"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">01:30
                                                                    PM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">Created
                                                                new layout whith tens of new options for Keen
                                                                Admin panel</a>
                                                            <div class="xv-timeline__item-info">
                                                                Vue,CSS,VueJS
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--danger">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_genius font-weight-bold text-danger"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">01:20
                                                                    AM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                Secyrity alert by Firewall &amp; order to take
                                                                aktion on User Preferences
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Security, Fieewall
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--brand">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_gift_alt font-weight-bold text-success"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">Yestardey</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                FlyMore design mock-ups been uploadet by
                                                                designers Bob, Naomi, Richard
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Hadrla, Sketch, AJ
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->


                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--danger">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_genius font-weight-bold text-danger"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">01:20
                                                                    AM</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                New secyrity alert by Firewall &amp; order to
                                                                take aktion on User Preferences
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Security, Fieewall
                                                            </div>
                                                        </div>
                                                        <!--End::Item -->

                                                        <!--Begin::Item -->
                                                        <div class="xv-timeline__item xv-timeline__item--warning">
                                                            <div class="xv-timeline__item-section">
                                                                <div class="xv-timeline__item-section-border">
                                                                    <div class="xv-timeline__item-section-icon">
                                                                        <i class="icon_datareport font-weight-bold text-warning"></i>
                                                                    </div>
                                                                </div>
                                                                <span class="xv-timeline__item-datetime">Aug
                                                                    15,2019</span>
                                                            </div>
                                                            <h6>The new Customer Contact</h6>
                                                            <a href="" class="xv-timeline__item-text">
                                                                With Xita Digital Corp ot Unit14, 3 Edigor
                                                                Buildings, George Street, Loondon<br> England,
                                                                BA12FJ
                                                            </a>
                                                            <div class="xv-timeline__item-info">
                                                                Meeting, Clint
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Article en stock -->
                    <div class="col-lg-8 col-xl-8 height-card box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title mb-30">Article en stock</h6>
                                <div class="table-responsive">
                                    <table class="table table-nowrap table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Article ID</th>
                                                <th>Nom</th>
                                                <th>Location</th>
                                                <th>Quantité</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($itemQuantities as $index => $itemQuantity)
                                            <tr>
                                                <td>{{ $itemQuantity->item_id }}</td>
                                                @if($index == 0 || $itemQuantity->item_id != $itemQuantities[$index - 1]->item_id)
                                                <td>{{ $itemQuantity->item->name }}</td>
                                                @else
                                                <td></td>
                                                @endif
                                                <td>{{ $itemQuantity->location->location_name }}</td>
                                                <td>{{ (int)$itemQuantity->quantity }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Encaissement  -->
                    <div class="col-lg-4 col-xl-4 height-card box-margin">
                        <div class="card">
                            <div class="card-header bg-transparent user-area d-flex align-items-center justify-content-between">
                                <h6 class="card-title mb-0">Encaissement</h6>
                                <ul class="nav nav-tabs mb-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link show active" id="sell-03-tab" data-bs-toggle="tab" href="#sell-03" role="tab" aria-controls="sell-03" aria-selected="true">ouvert</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mr-0" id="rent-04-tab" data-bs-toggle="tab" href="#rent-04" role="tab" aria-controls="rent-04" aria-selected="false">fermé</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab -->
                            <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                <div class="tab-content" id="ticketList">
                                    <div class="tab-pane fade active show" id="sell-03" role="tabpanel" aria-labelledby="sell-03-tab">
                                        <ul class="ticket-data-list">
                                            @if($usersOpened->isNotEmpty())
                                            @foreach($usersOpened as $user)
                                            <li>
                                                <div class="avatar-area d-flex">
                                                    <span class="avatar avatar-online warning-color mr-3">H</span>
                                                    <div class="avatar-text">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mr-2 mb-0">{{ $user->name }}</h6>
                                                            @if(isset($user->formatted_open_date))
                                                            <p class="ticket-time mb-0 font-12">Opened at: {{ $user->formatted_open_date }}</p>
                                                            @endif
                                                        </div>
                                                        <p>{{ $user->email }}</p>
                                                        @if(isset($user->formatted_open_date))
                                                        <span class="badge badge-pill badge-warning">ouvert</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif



                                            @if($usersOpened->isEmpty())
                                            <p>Aucun utilisateur n'a ouvert la caisse hier.</p>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="tab-pane fade" id="rent-04" role="tabpanel" aria-labelledby="rent-04-tab">
                                        <ul class="ticket-data-list">
                                            @if($usersClosed->isNotEmpty())
                                            @foreach($usersClosed as $user)
                                            <li>
                                                <div class="avatar-area d-flex">
                                                    <span class="avatar avatar-pending bg-danger mr-3">H</span>
                                                    <div class="avatar-text">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mr-2 mb-0">{{ $user->name }}</h6>
                                                            @if(isset($user->formatted_close_date))
                                                            <p class="ticket-time mb-0 font-12">Closed at: {{ $user->formatted_close_date }}</p>
                                                            @endif
                                                        </div>
                                                        <p>{{ $user->email }}</p>
                                                        @if(isset($user->formatted_close_date))
                                                        <span class="badge badge-pill text-bg-danger">fermé</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endif
                                            @if($usersClosed->isEmpty())
                                            <p>Aucun utilisateur n'a fermé la caisse hier.</p>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--   Vente suspendues et completes  -->
                    <!-- <div class="row"> -->
                    <!--   Vente suspendues  -->
                    <div class="col-lg-6 col-xl-6 height-card box-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Vente suspendues</h6>
                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-nowrap">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Date de vente</th>
                                                <th>Client</th>
                                                <th>Employe</th>
                                                <th>Commentaires</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($salesSuspendue as $sale)
                                            <tr>
                                                <td>{{ $sale->sale_time }}</td>
                                                <td>{{ $sale->customer->person->first_name }} {{ $sale->customer->person->last_name }}</td>
                                                <td>{{ $sale->user->people->first_name }} {{ $sale->user->people->last_name }}</td>
                                                <td>{{ $sale->comment }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                               
                                                    <button type="button" class="btn btn-outline-success" wire:click="edit({{  $sale->id }})">Modifier</button>
                                              
                                                    <button wire:click="generateInvoice({{ $sale->id }})" class="btn btn-success">Générer Facture</button>
                                </div>
                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--   Vente suspendues  -->
                <div class="col-lg-6 col-xl-6 height-card box-margin">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Vente Complètes</h6>
                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-hover table-nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Date de vente</th>
                                            <th>Client</th>
                                            <th>Employe</th>
                                            <th>Commentaires</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($salesComplete as $sale)
                                        <tr>
                                            <td>{{ $sale->sale_time }}</td>
                                            <td>{{ $sale->customer->person->first_name }} {{ $sale->customer->person->last_name }}</td>
                                            <td>{{ $sale->user->people->first_name }} {{ $sale->user->people->last_name }}</td>
                                            <td>{{ $sale->comment }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button type="button" class="btn btn-rounded btn-outline-success" wire:click="edit({{ $sale->id }})">
                                                        <span class="btn-inner--icon"><i class="fa fa-pencil"></i></span>
                                                        <span class="btn-inner--text">Modifier</span>
                                                    </button>
                                                    <button wire:click="generateInvoice({{ $sale->id }})" class="btn btn-rounded btn-outline-warning ml-2">
                                                        <span class="btn-inner--icon"><i class="fa fa-download"></i></span>
                                                        <span class="btn-inner--text">Facture</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- </div> -->
        </div>


    </div>
</div>
</div>