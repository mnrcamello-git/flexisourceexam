<?php

/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;


use App\Post;

use Exception;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use App\Repositories\CustomerRepository;

/**
 * Class deletePostsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class ImporterPostsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "import:posts";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import Customer randomly using randomuser API";

    private $customerRepository;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CustomerRepository $customerRepository)
    {
        try {

            $client = new \GuzzleHttp\Client();

            $customerRepository->insertCustomer(
                json_decode($client->request('GET', 'https://randomuser.me/api', [
                    'query'   => [
                        'nat' => 'AU',
                        'results' => 100
                    ],
                ])->getBody()->getContents())
            );
        } catch (Exception $e) {
            $this->error("An error occurred " . $e);
        }
    }
}
