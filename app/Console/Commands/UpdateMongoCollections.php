<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \Coccoc\Repositories\TokenDB;

class UpdateMongoCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mongo:update-collections {--init}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update MongoDB collections';


    /**
     * @var \Illuminate\Config\Repository|mixed
     */
    private $config;

    /**
     * @var \MongoDB\Database
     */
    private $db;

    /**
     * Create a new command instance.
     *
     * @param TokenDB $tokenDB
     */
    public function __construct(TokenDB $tokenDB)
    {
        parent::__construct();
        $this->config = config('mongo.collection_config');
        $this->db = $tokenDB->getDb();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Started updating collections.');

        if ($this->option('init')) {
            foreach ($this->config['init'] as $collectionName => $data) {
                $this->db->selectCollection($collectionName)->deleteOne(['name' => $data['name']]);
                $this->db->selectCollection($collectionName)->insertOne($data);
            }
        }

        $this->info('Finish updating collections.');
        return true;
    }
}
