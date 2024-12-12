document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-btn');
    const panes = document.querySelectorAll('.tab-pane');

    // タブ切り替え
    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((t) => t.classList.remove('active'));
            tab.classList.add('active');

            const target = tab.getAttribute('data-tab');
            panes.forEach((pane) => {
                pane.classList.toggle('active', pane.id === target);
            });
        });
    });

    // カードクリックで詳細ページ遷移
    const postCards = document.querySelectorAll('.post-card.clickable');
    postCards.forEach((card) => {
        card.addEventListener('click', () => {
            const route = card.getAttribute('data-route');
            if (route) {
                window.location.href = route;
            }
        });
    });

    // 編集ボタンのクリックで編集ページ遷移
    const editButtons = document.querySelectorAll('.edit-btn.clickable');
    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.stopPropagation(); // 親カードのクリックイベントを停止
            const route = button.getAttribute('data-route');
            if (route) {
                window.location.href = route;
            }
        });
    });

    // いいねボタンの処理（カウント機能付き）
    const likeBtns = document.querySelectorAll('.like-btn');
    likeBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.stopPropagation(); // 親カードのクリックイベントを停止

            const liked = btn.classList.contains('liked');
            const likeCountSpan = btn.nextElementSibling; // いいね数の要素を取得
            let likeCount = parseInt(likeCountSpan.textContent, 10);

            if (liked) {
                btn.classList.remove('liked');
                btn.textContent = '🤍'; // いいねを外す
                likeCount -= 1;
            } else {
                btn.classList.add('liked');
                likeCount += 1;
                btn.textContent = '❤️'; // いいねをつける
            }

            // カウントを更新
            likeCountSpan.textContent = likeCount;
        });
    });

    // コメントボタンの処理
    const commentBtns = document.querySelectorAll('.comment-btn');
    commentBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.stopPropagation(); // 親カードのクリックイベントを停止
            window.location.href = '/comment-page'; // コメントページに遷移
        });
    });
});
