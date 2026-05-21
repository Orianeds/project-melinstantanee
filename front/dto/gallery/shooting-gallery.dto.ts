import type { PhotoDto } from './photo.dto'

export interface ShootingGalleryDto {
  id: number
  status: string
  coverPhotoUrl: string | null
  photos: PhotoDto[]
}