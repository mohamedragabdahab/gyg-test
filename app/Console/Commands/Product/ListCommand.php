<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04.03.18
 * Time: 20:05
 */

namespace App\Console\Commands\Product;

use Illuminate\Console\Command;
use App\Services\ProductService;
use App\Validator\ProductValidator;

class ListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:list {end_point} {start_date} {end_date} {travelers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print List Of Available Products.';

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var ProductValidator
     */
    private $productValidator;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
        $this->productValidator = new ProductValidator();
    }

    public function handle()
    {
        $args = [
            ProductService::END_POINT => $this->argument(ProductService::END_POINT),
            ProductService::DATE_START => $this->argument(ProductService::DATE_START),
            ProductService::DATE_END => $this->argument(ProductService::DATE_END),
            ProductService::TRAVELERS => $this->argument(ProductService::TRAVELERS),
        ];

        $validate = $this->productValidator->validate($args);
        if ($validate->fails()) {
            echo $validate->messages() . PHP_EOL;
            die;
        }

        try {
            echo json_encode($this->productService->search($args)) . PHP_EOL;
        } catch (\Exception $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}