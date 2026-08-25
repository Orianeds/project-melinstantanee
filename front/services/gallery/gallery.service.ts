import { PaginatedPhotosDto } from '@/dto/gallery/paginated-photos.dto'

const API_URL = process.env.NEXT_PUBLIC_API_URL

export async function fetchGalleryPhotos(
  shootingId: number,
  page = 1,
  limit = 20,
): Promise<PaginatedPhotosDto> {
  const response = await fetch(
    `${API_URL}/api/shootings/${shootingId}/photos?page=${page}&limit=${limit}`,
    {
      cache: 'no-store',
    }
  )

  if (!response.ok) {
    throw new Error('Failed to fetch gallery photos')
  }

  return response.json()
}