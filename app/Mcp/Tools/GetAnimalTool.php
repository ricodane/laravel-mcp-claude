<?php

namespace App\Mcp\Tools;

use App\Models\Animal;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[Description('Get one shelter animal by its ID: name, species, breed, age, adoption status and the date it arrived.')]
#[IsReadOnly]
class GetAnimalTool extends Tool
{
    // Runs when Claude calls the tool. Think of it like a controller method.
    public function handle(Request $request): Response
    {
        $validated = $request->validate(
            ['id' => 'required|integer'],
            ['id.required' => 'You must provide an animal ID, for example 8.']
        );

        $animal = Animal::find($validated['id']);

        if (! $animal) {
            return Response::error("No animal found with ID {$validated['id']}.");
        }

        return Response::text(json_encode([
            'name' => $animal->name,
            'species' => $animal->species,
            'breed' => $animal->breed,
            'age' => $animal->age_years,
            'status' => $animal->status,
            'arrived_on' => $animal->arrived_at->toDateString(),
        ]));
    }

    // The inputs Claude is allowed to send
    public function schema(JsonSchema $schema): array
    {
        return [
            'id' => $schema->integer()
                ->description('The animal ID.')
                ->required(),
        ];
    }
}
