import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import path from 'path';
import {fileURLToPath} from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

export default (env, args) => {
	const isProduction = args.mode === 'production';
	return {
		context: path.resolve(__dirname),
		entry: './src/Application/UI/client/index.js',
		output: {
			path: path.resolve(__dirname, 'public/assets'),
			publicPath: isProduction ? '/assets/' : '/',
		},
		module: {
			rules: [
				{
					test: /\.css$/,
					use: [
						MiniCssExtractPlugin.loader,
						'css-loader',
					],
				}
			],
		},
		plugins: [
			new MiniCssExtractPlugin(),
		],
		devServer: {
			port: 3000,
			static: [
				path.resolve(__dirname, 'public/assets'),
			],
		},
	};
};
