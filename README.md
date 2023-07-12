# waggo8.1用Vite導入補助プラグイン


## インストール

1. `sys/plugins/waggo81-vite`にプラグインパッケージを展開する。

2. `install/install.sh`を実行する。
   補助スクリプト等のコピー、npmパッケージのインストールを行います。


## 使用方法

1. Viteを通して使用したいjs, scss等のアセットファイルを`assets`ディレクトリに配置する。(以下例)
     - `assets/main.ts`
     - `assets/style.scss`

2. テンプレートに以下のように記述する。
   ```html
   <html>
     <head>
       ...
       <link rel="stylesheet" href="/assets/style.scss" />
     </head>
     <body>
       ...
       <script type="module" src="/assets/main.ts"></script>
       <?= WGPluginVite::client() ?>
     </body>
   </html> 
   ```
   ビルド前後でパスを書き換える必要はありません。

3. 配信環境へデプロイする場合、 `node build.js`を実行してアセットファイルをビルドする。


## 仕組み

`/assets/main.ts`にアクセスがあった場合...

1. `pub/assets/main.ts`が存在しない場合、`pub/assets/index.php?_=main.ts`にリライトする。

2. `pub/assets/index.php`はマニフェスト(`pub/assets/manifest.json`)を参照し、
   - マニフェストがない場合はViteのURlへリダイレクトする。
   - マニフェストがありかつ(ビルド済)実ファイルがある場合はそちらへリダイレクトする。
   - マニフェストがありかつ(ビルド済)実ファイルがない場合は404を返す。
