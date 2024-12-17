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
    document.querySelectorAll('.post-card').forEach(card => {
        card.addEventListener('click', function(event) {
            // ボタンがクリックされた場合は詳細ページに遷移しない
            if (event.target.closest('.like-button') || event.target.closest('.comment-btn') || event.target.closest('.edit-btn')) {
                return;
            }
    
            // 詳細ページに遷移
            const route = card.dataset.route;
            window.location.href = route; // 詳細ページへ遷移
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
