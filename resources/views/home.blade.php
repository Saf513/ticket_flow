@extends('layouts.app')  <!-- Si tu as déjà un layout Blade principal avec header et footer -->

@section('content')
    <!-- 🌟 Section Hero -->
    <section class="bg-indigo-600 text-white text-center py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-4">Bienvenue sur Ticket Flow</h2>
            <p class="text-lg mb-6">La solution ultime pour la gestion de vos tickets et événements.</p>
            <a href="#signup" class="bg-white text-indigo-600 px-6 py-3 rounded-full text-xl font-semibold hover:bg-gray-100 transition">Inscrivez-vous maintenant</a>
        </div>
    </section>

    <!-- 🚀 Fonctionnalités -->
    <section class="container mx-auto px-6 py-20">
        <h2 class="text-3xl font-bold text-center mb-12">Fonctionnalités</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold mb-4">Gestion des Tickets</h3>
                <p>Suivez, gérez et attribuez des tickets facilement à votre équipe.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold mb-4">Notifications en Temps Réel</h3>
                <p>Recevez des notifications instantanées sur vos tickets et mises à jour.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h3 class="text-xl font-semibold mb-4">Tableau de Bord Intuitif</h3>
                <p>Suivez les performances de vos tickets grâce à un tableau de bord interactif.</p>
            </div>
        </div>
    </section>

    <!-- 💬 Témoignages -->
    <section class="bg-gray-50 py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12">Ce que nos utilisateurs disent</h2>
            <div class="flex justify-center space-x-6">
                <div class="bg-white p-8 rounded-xl shadow-md max-w-xs">
                    <p class="text-lg mb-4">"Ticket Flow a changé la manière dont nous gérons nos tickets, tout est devenu plus facile!"</p>
                    <strong>- Sarah, Manager</strong>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md max-w-xs">
                    <p class="text-lg mb-4">"Le tableau de bord interactif est une véritable révolution pour nous!"</p>
                    <strong>- Maxime, Développeur</strong>
                </div>
            </div>
        </div>
    </section>

    <!-- 📈 Call to Action -->
    <section id="signup" class="bg-indigo-600 text-white text-center py-20">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-4">Prêt à commencer ?</h2>
            <p class="text-lg mb-6">Rejoignez Ticket Flow et transformez la gestion de vos tickets.</p>
            {{-- <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-6 py-3 rounded-full text-xl font-semibold hover:bg-gray-100 transition">S'inscrire</a> --}}
        </div>
    </section>
@endsection
