/**
 * Enter キーの単体入力を検出する
 * @param event - KeyboardEvent
 * @returns boolean - Enterキーが押されたかどうか
 */
export const isEnterKey = (event: KeyboardEvent): boolean => {
  return event.key === "Enter" && !event.shiftKey;
};

/**
 * キーボードショートカットのハンドラーを作成する
 * @param callback - ショートカットが検出されたときに実行する関数
 * @returns KeyboardEventHandler
 */
export const createShortcutHandler = (callback: () => void) => {
  return (event: KeyboardEvent) => {
    if (isEnterKey(event)) {
      event.preventDefault();
      callback();
    }
  };
};
