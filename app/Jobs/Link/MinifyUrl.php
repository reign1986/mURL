<?php

namespace App\Jobs\Link;

use App\Link;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MinifyUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Minified URL length
     *
     * @var int
     */
    private $length;

    /**
     * Minified URL MAX length
     *
     * @var int
     */
    private $maxLengh;

    /**
     * Create a new job instance.
     *
     * @param int $length
     * @param int $maxLengh
     */
    public function __construct(int $length = 4, int $maxLengh = 255)
    {
        $this->length = $length;
        $this->maxLengh = $maxLengh;
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle()
    {
        do {
            $mUrl = $this->generate();

        } while (!$this->isUnique($mUrl));

        return $mUrl;
    }

    /**
     * Check unique Minified URL
     *
     * @param $mUrl
     * @return bool
     */
    protected function isUnique($mUrl)
    {

        return Link::where('murl', $mUrl)->first() === null;
    }

    /**
     * Generate Minified URL
     *
     * @return string
     */
    protected function generate()
    {
        if ($this->length > $this->maxLengh) {
            $this->length = $this->maxLengh;
        }

        return str_random($this->length);
    }
}
