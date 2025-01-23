<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SendProductToWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:send-to-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправляет информацию о продукте с наибольшим ID на внешний webhook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $product = Product::orderBy('id', 'desc')->first();

        if (!$product) {
            $this->info('Продукты не найдены.');
            return;
        }

        $webhookUrl = config('products.webhook');

        $response = Http::post($webhookUrl, [
            'id' => $product->id,
            'name' => $product->name,
            'article' => $product->article,
        ]);

        if ($response->successful()) {
            $this->info('Информация о продукте успешно отправлена на webhook.');
        } else {
            $this->error('Не удалось отправить информацию о продукте на webhook.');
        }
    }
}
