<?php

namespace MohammadZarifiyan\LaravelLocaleKit;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class LocaleKitProvider extends ServiceProvider implements DeferrableProvider
{
	public function register(): void
	{
		$this->app->bind(LocaleManager::class , function (Application $application) {
			$defaultLocale = $application->getLocale();

			return new LocaleManager($defaultLocale);
		});
	}

	public function boot(): void
	{
		$this->publishes(
			[__DIR__.'/../locales' => base_path('locales')],
			'locale-kit-locales'
		);
	}

	public function provides(): array
	{
		return [LocaleManager::class];
	}
}

