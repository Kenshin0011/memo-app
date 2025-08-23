import api from "@/bootstrap";
import { CreateMemoPayload, Memo } from "@/features/memos/types/memoTypes";

const BASE_URL = "/memos";

/**
 * メモ一覧を取得する
 */
export const fetchMemos = async () => {
  try {
    const { data } = await api.get<Memo[]>(BASE_URL);
    return { success: true, data: data };
  } catch (error) {
    return { success: false, error };
  }
};

/**
 * メモ作成する
 * @param payload
 */
export const createMemo = async (payload: CreateMemoPayload) => {
  try {
    await api.post(BASE_URL, payload);
    return { success: true };
  } catch (error) {
    return { success: false, error };
  }
};
