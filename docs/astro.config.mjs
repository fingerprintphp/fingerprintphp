// @ts-check
import { defineConfig } from 'astro/config';
import starlight from '@astrojs/starlight';

export default defineConfig({
	site: 'https://fingerprintphp.github.io',
	base: '/fingerprintphp',
	integrations: [
		starlight({
			title: 'FingerprintPHP',
			description: 'PHP wrapper for browser fingerprinting. Track visitors across sessions without cookies.',
			social: [
				{ icon: 'github', label: 'GitHub', href: 'https://github.com/fingerprintphp/fingerprintphp' },
			],
			credits: false,
			customCss: ['./src/styles/custom.css'],
			components: {
				Footer: './src/components/Footer.astro',
			},
			sidebar: [
				{
					label: 'Getting Started',
					items: [
						{ label: 'Installation', slug: 'getting-started/installation' },
						{ label: 'Quick Start', slug: 'getting-started/quickstart' },
					],
				},
				{
					label: 'Usage',
					items: [
						{ label: 'JavaScript Options', slug: 'usage/javascript-options' },
						{ label: 'Handling Requests', slug: 'usage/handling-requests' },
					],
				},
				{
					label: 'API Reference',
					items: [
						{ label: 'FingerprintClient', slug: 'api/fingerprint-client' },
						{ label: 'FingerprintData', slug: 'api/fingerprint-data' },
					],
				},
				{
					label: 'Storage',
					items: [
						{ label: 'File Storage', slug: 'storage/file-storage' },
						{ label: 'Custom Storage', slug: 'storage/custom-storage' },
					],
				},
				{
					label: 'Guides',
					items: [
						{ label: 'Laravel Integration', slug: 'guides/laravel' },
						{ label: 'Vanilla PHP', slug: 'guides/vanilla-php' },
						{ label: 'Fraud Detection', slug: 'guides/fraud-detection' },
						{ label: 'Visitor Analytics', slug: 'guides/visitor-analytics' },
					],
				},
			],
		}),
	],
});
