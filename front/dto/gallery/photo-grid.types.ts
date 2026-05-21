import { PhotoDto } from "./photo.dto"

export type PhotoGridProps = {
  photos: PhotoDto[]
  onPhotoClick?: (photo: PhotoDto) => void
}