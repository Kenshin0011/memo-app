import api from "@/bootstrap";
import { CreateMemoPayload } from "@/features/memos/types/memoTypes";

const BASE_URL = "/memos";

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
