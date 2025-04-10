@include('Chatify::layouts.headLinks')

<div class="messenger">
    {{-- ----------------------Section Utilisateurs/Groupes---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- En-tête et barre de recherche --}}
        <div class="m-header">
            <nav  style="display: flex; align-items: center; justify-content: space-between;">
                <a href="#" style="display: flex; align-items: center;"><img src="{{ asset('images/logo.png') }}" alt="" srcset="" style="width: 35px;"> <span class="messenger-headTitle">TALKA</span> </a>
                {{-- Boutons de l’en-tête --}}
                <nav class="m-header-right">
                    <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <button type="submit" style="background-color: transparent; border: none; outline: none;">
                            <span class="{{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch" data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span>
                            <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                        </button>
                    </form>
                </nav>
            </nav>
            {{-- Champ de recherche --}}
            <input type="text" class="messenger-search" placeholder="Rechercher" />
            {{-- Onglets (désactivé ici) --}}
            {{-- <div class="messenger-listView-tabs">
                <a href="#" class="active-tab" data-view="users">
                    <span class="far fa-user"></span> Contacts</a>
            </div> --}}
        </div>

        {{-- Onglets et listes --}}
        <div class="m-body contacts-container">
           {{-- Liste [Utilisateurs/Groupes] --}}
           {{-- ---------------- [ Onglet Utilisateurs ] ---------------- --}}
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favoris --}}
               <div class="favorites-section">
                <p class="messenger-title"><span>Favoris</span></p>
                <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               {{-- Messages enregistrés --}}
               <p class="messenger-title"><span>Mon espace</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}
               {{-- Contacts --}}
               <p class="messenger-title"><span>Tous les messages</span></p>
               <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;"></div>
           </div>

           {{-- ---------------- [ Onglet Recherche ] ---------------- --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                {{-- Résultats --}}
                <p class="messenger-title"><span>Recherche</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Tapez pour rechercher...</span></p>
                </div>
           </div>
        </div>
    </div>

    {{-- ----------------------Zone de messagerie---------------------- --}}
    <div class="messenger-messagingView" style="background: url(); background-size: cover; ba">
        {{-- En-tête [nom de la conversation] et boutons --}}
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                {{-- Retour, avatar et nom --}}
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar" style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;"></div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                {{-- Boutons d’en-tête --}}
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>

            {{-- Connexion Internet --}}
            <div class="internet-connection">
                <span class="ic-connected">Connecté</span>
                <span class="ic-connecting">Connexion en cours...</span>
                <span class="ic-noInternet">Pas de connexion Internet</span>
            </div>
        </div>

        {{-- Zone des messages --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Veuillez sélectionner une discussion pour commencer</span></p>
            </div>
            {{-- Indicateur de frappe --}}
            <div class="typing-indicator">
                <div class="message-card typing">
                    <div class="message">
                        <span class="typing-dots">
                            <span class="dot dot-1"></span>
                            <span class="dot dot-2"></span>
                            <span class="dot dot-3"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulaire d’envoi --}}
        @include('Chatify::layouts.sendForm')
    </div>

    {{-- ----------------------Vue Info---------------------- --}}
    <div class="messenger-infoView app-scroll">
        {{-- Actions de navigation --}}
        <nav>
            <p>Détails de l'utilisateur</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
