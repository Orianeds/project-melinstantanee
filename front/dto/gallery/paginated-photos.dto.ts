import { PhotoDto } from './photo.dto'

export interface PaginatedPhotosDto {
  data: PhotoDto[]
  page: number
  limit: number
  total: number
}