<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Spatie\ImageOptimizer\OptimizerChainFactory;
use Spatie\Image\Image;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $filename)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $optimizerChain = OptimizerChainFactory::create();
            
            info('filename: ' . $this->filename);
       
            $image_path = public_path('storage/' . $this->filename);

            $image = Image::load($image_path);
            $width = $image->getWidth();

            if ($width > 1000) {
                $optimizerChain->optimize($image_path);
                $image->width(640)->save();
            }
        } catch (\Exception $e) {
            info('image optimization error: ' . $e->getMessage());
        }
    }
}
