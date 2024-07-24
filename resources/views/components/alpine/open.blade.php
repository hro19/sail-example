<!-- x-dataで書いたオブジェクトは子要素からアクセス可能、ここではopen状態の値を保持するやつ -->
<div x-data="{ open: false }" class="block">
    <!-- @click は onclick の代わりだよ。クリックしたら open=true を代入する(開くよ)  -->
    <button @click="open = true" x-text="open ? '開いてるよ' : 'クリックで開くよ'"></button>

    <!-- x-show は 指定した変数や式が true なら、表示するよ -->
    <span
        x-show="open"
        @click.away="open = false"
        class="border-2 border-lime-500 p-2 m-4"
    >
        開いたよ。この枠の外をクリックすると、閉じるよ。
    </span>
    <!-- @click.away の .away は「ここ以外を xxしたら(clickしたら)」 の修飾子だよ。 
         「画面外をクリックしたら」でよく使うよね  -->
</div>