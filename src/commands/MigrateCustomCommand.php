<?php namespace Obarlas\LaravelMigrateCustomCommand;

use \Illuminate\Console\Command;
use \Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Input\InputArgument;
use \Illuminate\Filesystem\Filesystem;

class MigrateCustomCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migrate:custom';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create database migration scripts from custom database templates.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Filesystem $files) {
		parent::__construct();

		$this->files = $files;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		$stub = $this->argument('stub');
		$class = $this->argument('class');
		$table = $this->option('table');

		// Check if file exists.
		$file = app_path() . "/database/templates/" . $stub . ".stub";
		if (!$this->files->isFile($file)) {
			$this->error("There is no stub with this name.");
			exit;
		}

		// Get the contents of the file.
		$contents = $this->files->get($file);

		// Replace class name with our variable.
		$contents = str_replace('{{class}}', studly_case($class), $contents);

		// Check if file has a table variable and stop if a table variable is not
		// passed
		if (strstr($contents, '{{table}}') and empty($table)) {
			$this->error("A table name should be given by --table option.");
			exit;
		}
		$contents = str_replace('{{table}}', $table, $contents);

		// Write the file according to the migration file naming rules.
		$this->files->put(app_path() . "/database/migrations/" . date("Y_m_d_His") . "_" . $class . ".php", $contents);

		// Dump the contents for checking.
		$this->info($contents);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return [
			['stub', InputArgument::REQUIRED, 'Stub name.'],
			['class', InputArgument::REQUIRED, 'Class name.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions() {
		return [
			['table', null, InputOption::VALUE_OPTIONAL, 'Table name']
		];
	}

}
