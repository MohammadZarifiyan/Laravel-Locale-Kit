<?php

namespace MohammadZarifiyan\LaravelLocaleKit\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use MohammadZarifiyan\LaravelLocaleKit\LocaleManager;

class DeferredServiceProvider extends ServiceProvider implements DeferrableProvider
{
	public function register(): void
	{
		$this->app->singleton(LocaleManager::class, fn () => new LocaleManager);
	}

	public function provides(): array
	{
		return [LocaleManager::class];
	}
}