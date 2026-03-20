<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); #identifiant
            $table->timestamps(); #dates de création et de mise à jour
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); #identifiant de la salle réservée
                                                       #->cascadeOnDelete();

            #constrained() pour créer une clé étrangère qui référence l'identifiant de la salle dans la table rooms
            #onDelete('cascade') pour supprimer les réservations associées si une salle est supprimée
            $table->string('user_name', 255); #nom de la personne qui a réservé la salle
            $table->date('date'); #date de la réservation
            $table->time('start_time'); #heure de début
            $table->time('end_time'); #heure de fin
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
