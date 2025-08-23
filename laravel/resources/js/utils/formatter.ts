export const useFormatter = () => {
  /**
   * 日時文字列を表示用にフォーマットする
   * @param dateString - ISO形式の日時文字列
   * @returns YYYY-MM-DD HH:mm形式の文字列
   */
  const formatDateTime = (dateString: string): string => {
    const date = new Date(dateString);

    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, "0");
    const day = String(date.getDate()).padStart(2, "0");
    const hours = String(date.getHours()).padStart(2, "0");
    const minutes = String(date.getMinutes()).padStart(2, "0");

    return `${year}-${month}-${day} ${hours}:${minutes}`;
  };
  
  return {
    formatDateTime,
  };
};
