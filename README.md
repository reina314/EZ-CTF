# EZ-CTF
初学者向けに作成した、CTFのDockerイメージです。<br>
`cd`や`ls`などの基本的なコマンドから、公開鍵認証を利用した`ssh`接続、初歩的なパスジャッキングによる権限昇格(PrivEsc)に至るまで、幅広い手法を網羅しています（したつもりです）。<br>
DockerおよびDocker Composeの実行環境さえあれば、簡単に実行できます。

## 実行方法
1.レポジトリをクローンします。
```bash
git clone https://github.com/reina314/EZ-CTF.git
```
2.Dockerコンテナを起動します。初回起動時は、イメージのビルドのために時間がかかります。
```bash
cd EZ-CTF
docker-compose up -d
```
3.フラグ提出用のWebページをお好みのブラウザで開きます。デフォルトのポート番号は`8080`です。
```bash
http://<IP Address>:8080
```
4.コンテナにSSH接続します。デフォルトのポート番号は`2222`です。クレデンシャルは、`ctfplayer:ctf1234`です。
```bash
ssh ctfplayer@<IP Address> -p 2222
```
あとは解くだけです。

5.終わったら、Dockerコンテナを終了させることを忘れないでください。
```bash
docker-compose stop
```

## フラグ
フラグは全部で10個あります。全てのフラグは、`FLAG{...}`の書式に従っています。<br>
答えや解法は、`Dockerfile`や`index.php`の該当箇所を参考にしてください。<br>
そのうち暇な時にWalkthroughを追記するかもしれません。

