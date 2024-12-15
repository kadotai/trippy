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
        btn.addEventListener('click', async (event) => {
            event.stopPropagation(); // 親カードのクリックイベントを停止

            const postId = btn.getAttribute('data-post-id');
            const liked = btn.classList.contains('liked');
            const likeCountSpan = btn.nextElementSibling; // いいね数の要素を取得
            let likeCount = parseInt(likeCountSpan.textContent, 10);

            // Ajaxリクエストで「いいね」の状態をサーバーに反映
            try {
                const response = await fetch(`/like/${postId}`, {
                    method: liked ? 'DELETE' : 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ post_id: postId }),
                });

                if (response.ok) {
                    if (liked) {
                        btn.classList.remove('liked');
                        btn.textContent = '🤍'; // いいねを外す
                        likeCount -= 1;
                    } else {
                        btn.classList.add('liked');
                        btn.textContent = '❤️'; // いいねをつける
                        likeCount += 1;
                    }

                    // カウントを更新
                    likeCountSpan.textContent = likeCount;
                } else {
                    console.error('Error liking the post');
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    // コメントボタンの処理
    const commentBtns = document.querySelectorAll('.comment-btn');
    commentBtns.forEach((btn) => {
        btn.addEventListener('click', (event) => {
            event.stopPropagation(); // 親カードのクリックイベントを停止
            const postId = btn.closest('.post-card').getAttribute('data-route');
            window.location.href = `/post/${postId}/comments`; // コメントページに遷移
        });
    });
});
