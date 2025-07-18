import { defineConfig } from 'vite';
import nette from '@nette/vite-plugin';

export default defineConfig({
	plugins: [
		nette({
			entry: 'main.js',
		}),
	],

	build: {
		emptyOutDir: true,
		outDir: '../www/assets',
		manifest: true,
	},

	css: {
		devSourcemap: true,
	},
});
