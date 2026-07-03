<?php

namespace MohammadZarifiyan\LaravelLocaleKit\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use MohammadZarifiyan\LaravelLocaleKit\LocaleKit;

class Export extends Command
{
	protected $signature = 'locale-kit:export {path : The path where the file will be exported}';

	protected $description = 'Export all locale definitions as JSON file.';

	/**
	 * @throws \JsonException
	 */
	public function handle(): int
	{
		$path = $this->argument('path');

		if (!str_starts_with($path, DIRECTORY_SEPARATOR)) {
			$path = base_path($path);
		}

		$directory = dirname($path);

		File::ensureDirectoryExists($directory);

		$result = File::put($path, $this->generateFileContent());

		if ($result) {
			$this->info(sprintf('File saved to "%s".', $path));

			return Command::SUCCESS;
		}
		else {
			$this->error(sprintf('File could not be saved to "%s".', $path));

			return Command::FAILURE;
		}
	}

	/**
	 * @throws \JsonException
	 */
	protected function generateFileContent(): string
	{
		$data = [
			'locales' => LocaleKit::locales(),
			'defined_locales' => LocaleKit::definedLocales(),
			'aliases' => LocaleKit::aliases(),
			'definitions' => LocaleKit::definitions(),
		];

		return json_encode($data, JSON_THROW_ON_ERROR);
	}
}
