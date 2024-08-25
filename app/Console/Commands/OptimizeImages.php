<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\Image\Image;


class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-images {filename}';

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
        $filename = $this->argument('filename');
        $pathToImage = public_path('storage/' . $filename);
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($pathToImage);

        $image = Image::load($pathToImage);

        $width = $image->getWidth();

        $this->info('image width: ' . $width);

        if ($width > 1000) {
            $image->width(640)->save();
        }
    }
}
