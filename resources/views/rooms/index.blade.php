<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet-Up Manager - Réservation de salles</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Meet-Up Manager</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Formulaire de réservation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">Nouvelle réservation</h2>
                    
                    <form action="{{ route('reservations.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="room_id" class="block text-gray-700 text-sm font-bold mb-2">Salle *</label>
                            <select name="room_id" id="room_id" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('room_id') border-red-500 @enderror" required>
                                <option value="">Sélectionnez une salle</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="user_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du réservant *</label>
                            <input type="text" name="user_name" id="user_name" value="{{ old('user_name') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('user_name') border-red-500 @enderror" required>
                            @error('user_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date *</label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('date') border-red-500 @enderror" required>
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Heure de début *</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('start_time') border-red-500 @enderror" required>
                            @error('start_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="end_time" class="block text-gray-700 text-sm font-bold mb-2">Heure de fin *</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('end_time') border-red-500 @enderror" required>
                            @error('end_time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                            Réserver
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Liste des salles avec leurs réservations -->
            <div class="lg:col-span-2">
                <h2 class="text-xl font-semibold mb-4">Salles disponibles</h2>
                
                @forelse($rooms as $room)
                    <div class="bg-white rounded-lg shadow-md mb-6 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $room->name }}</h3>
                        </div>
                        
                        <div class="p-6">
                            @if($room->reservations && $room->reservations->count() > 0)
                                <h4 class="font-semibold text-gray-700 mb-3">Réservations :</h4>
                                <div class="space-y-2">
                                    @foreach($room->reservations as $reservation)
                                        <div class="bg-gray-50 rounded p-3">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-medium text-gray-800">{{ $reservation->user_name }}</p>
                                                    <p class="text-sm text-gray-600">
                                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }} 
                                                        de {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} 
                                                        à {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">vide</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <p class="text-gray-500">Aucune salle disponible</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>