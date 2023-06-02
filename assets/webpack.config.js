/**
 * Webpack configuration.
 */
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
// const OptimizeCssAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const cssnano = require("cssnano");
// const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CopyPlugin = require("copy-webpack-plugin"); // https://webpack.js.org/plugins/copy-webpack-plugin/

// JS Directory path.
const JS_DIR = path.resolve(__dirname, "src/js");
const IMG_DIR = path.resolve(__dirname, "src/img");
const LIB_DIR = path.resolve(__dirname, "src/library");
const BUILD_DIR = path.resolve(__dirname, "build");

const entry = {
  main: JS_DIR + "/main.js",
  single: JS_DIR + "/single.js",
  editor: JS_DIR + "/editor.js",
  woocommerce: JS_DIR + "/woocommerce.js",
};

const output = {
  path: BUILD_DIR,
  filename: "js/[name].js",
};

const rules = [
  {
    test: /\.js$/,
    include: [JS_DIR],
    exclude: /node_modules/,
    use: "babel-loader",
  },
  {
    test: /\.scss$/,
    exclude: /node_modules/,
    use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
  },
  {
    test: /\.(png|jpg|svg|jpeg|gif|ico)$/,
    use: [
      {
        loader: "file-loader",
        options: {
          name: "[path][name].[ext]",
          publicPath: "production" === process.env.NODE_ENV ? "../" : "../../",
          esModule: false,
        },
      },
    ],
  },
  {
    test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
    exclude: [IMG_DIR, /node_modules/],
    type: "javascript/auto",
    use: {
      loader: "file-loader",
      options: {
        name: "[path][name].[ext]",
        publicPath: "production" === process.env.NODE_ENV ? "../" : "../../",
        esModule: false,
      },
    },
  },
];

const plugins = (argv) => [
  new CleanWebpackPlugin({
    cleanStaleWebpackAssets: argv.mode === "production",
  }),

  new MiniCssExtractPlugin({
    filename: "css/[name].css",
  }),

  new CopyPlugin({
    patterns: [{ from: LIB_DIR, to: BUILD_DIR + "/library" }],
  }),
];

module.exports = (env, argv) => ({
  entry: entry,
  output: output,
  devtool: "source-map",
  module: {
    rules: rules,
  },

  optimization: {
    minimizer: [
      // new OptimizeCssAssetsPlugin({
      //   cssProcessor: cssnano,
      // }),

      new CssMinimizerPlugin(),
      new TerserPlugin(),

      // new UglifyJsPlugin({
      //   cache: false,
      //   parallel: true,
      //   sourceMap: false,
      // }),
    ],
  },

  plugins: plugins(argv),

  externals: {
    jquery: "jQuery",
  },
});
