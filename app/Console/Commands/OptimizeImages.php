<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\Image\Image;
use DB;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimizes uploaded images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $foods = DB::table('foods')->get();

        $optimizerChain = OptimizerChainFactory::create();

        foreach ($foods as $food) {

            if ($food->title_image) {
                $this->optimizeImage($optimizerChain, $food->title_image);
            }

            if ($food->nutrition_label_image) {
                $this->optimizeImage($optimizerChain, $food->nutrition_label_image);
            }

            if ($food->ingredients_image) {
                $this->optimizeImage($optimizerChain, $food->ingredients_image);
            }

            if ($food->barcode_image) {
                $this->optimizeImage($optimizerChain, $food->barcode_image);
            }   

        }

    }


    private function optimizeImage($optimizerChain, $filename)
    {
        try {
            $fixed_filename = substr($filename, 1);
            $this->info($fixed_filename);
            $image_path = public_path('storage/' . $fixed_filename);

            $image = Image::load($image_path);
            $width = $image->getWidth();

            // $this->info('image width: ' . $width);

            if ($width > 1000) {
                
                $optimizerChain->optimize($image_path);

                $image->width(640)->save();
            }
        } catch (\Exception $e) {
            $this->info('error: ' . $e->getMessage());
        }
        
    }
}
