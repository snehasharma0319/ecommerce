<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            'smartphone.jpg' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=800&auto=format&fit=crop&q=60',
            'laptop.jpg' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800&auto=format&fit=crop&q=60',
            'tshirt.jpg' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&auto=format&fit=crop&q=60',
            'jeans.jpg' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&auto=format&fit=crop&q=60',
            'coffee-maker.jpg' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?w=800&auto=format&fit=crop&q=60',
            'smartwatch.jpg' => 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=800&auto=format&fit=crop&q=60',
            'book.jpg' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=800&auto=format&fit=crop&q=60',
            'earbuds.jpg' => 'https://images.unsplash.com/photo-1606220588915-7b527cdb3b6b?w=800&auto=format&fit=crop&q=60',
        ];

        $this->command->info('Downloading product images...');

        foreach ($images as $filename => $url) {
            $this->command->info("Downloading {$filename}...");
            
            try {
                $response = Http::get($url);
                
                if ($response->successful()) {
                    Storage::disk('public')->put("products/{$filename}", $response->body());
                    $this->command->info("Successfully downloaded {$filename}");
                } else {
                    $this->command->error("Failed to download {$filename}");
                }
            } catch (\Exception $e) {
                $this->command->error("Error downloading {$filename}: " . $e->getMessage());
            }
        }

        $this->command->info('All images downloaded successfully!');
    }
} 