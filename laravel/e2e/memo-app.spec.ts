import { test, expect, type Page } from "@playwright/test";

test.beforeEach(async ({ page }) => {
  await page.goto("/");
});

const MEMO_ITEMS = [
  "今日の会議の議事録を作成する",
  "プロジェクトの進捗報告書を準備",
  "クライアントへの提案資料を見直し",
] as const;

test.describe("メモアプリ - 基本操作", () => {
  test("メモを追加できること", async ({ page }) => {
    // 最初のメモを追加
    await addMemo(page, MEMO_ITEMS[0]);

    // メモが追加されたことを確認
    await expect(page.getByText(MEMO_ITEMS[0]).first()).toBeVisible();
  });

  test("複数のメモを追加できること", async ({ page }) => {
    // 複数のメモを追加
    for (const item of MEMO_ITEMS) {
      await addMemo(page, item);
      await expect(page.getByText(item).first()).toBeVisible();
    }
  });

  test("メモを削除できること", async ({ page }) => {
    // メモを追加
    await addMemo(page, MEMO_ITEMS[0]);
    await expect(page.getByText(MEMO_ITEMS[0]).first()).toBeVisible();

    // メモ追加後のカウントを取得
    const initialCount = await page.getByText(MEMO_ITEMS[0]).count();

    // 最新のメモ（最初に表示される）の削除ボタンをクリック
    const firstMemoCard = page.locator("section").locator("div.group").first();
    // メモカードにホバーして削除ボタンを表示
    await firstMemoCard.hover();
    const deleteButton = firstMemoCard.locator('button[aria-label*="削除"]');
    await deleteButton.click();

    // メモが1件減ったことを確認
    await expect(page.getByText(MEMO_ITEMS[0])).toHaveCount(initialCount - 1);
  });
});

test.describe("メモアプリ - フォームバリデーション", () => {
  test("空のメモは追加できないこと", async ({ page }) => {
    const addButton = page.locator('button[type="submit"]');

    // ボタンが無効化されていることを確認
    await expect(addButton).toBeDisabled();
  });

  test("入力後にフォームがクリアされること", async ({ page }) => {
    const descriptionInput = page.locator("textarea#memo-input");

    await addMemo(page, MEMO_ITEMS[0]);

    // フォームがクリアされていることを確認
    await expect(descriptionInput).toHaveValue("");
  });
});

test.describe("メモアプリ - UI表示", () => {
  test("ページタイトルが正しく表示されること", async ({ page }) => {
    await expect(page).toHaveTitle("Vue App");
  });

  test("メモリストが表示されること", async ({ page }) => {
    // メモリストの存在を確認
    const memoList = page.locator("section");
    await expect(memoList).toBeVisible();
  });

  test("メモ追加フォームが表示されること", async ({ page }) => {
    // 入力フォームの存在を確認
    await expect(page.locator("textarea#memo-input")).toBeVisible();
    await expect(page.locator('button[type="submit"]')).toBeVisible();
  });
});

// ヘルパー関数
async function addMemo(page: Page, description: string) {
  const descriptionInput = page.locator("textarea#memo-input");
  const addButton = page.locator('button[type="submit"]');

  // フォームが空の状態から開始することを確認
  await expect(descriptionInput).toHaveValue("");

  // 1文字ずつ入力してバリデーションをトリガー
  await descriptionInput.pressSequentially(description);
  await expect(addButton).toBeEnabled();
  await addButton.click();

  // メモ送信後、フォームがクリアされるまで待機
  await expect(descriptionInput).toHaveValue("");
}
