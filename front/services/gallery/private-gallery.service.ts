import type { ShootingGalleryDto } from '@/dto/gallery/shooting-gallery.dto'

const API_URL = process.env.NEXT_PUBLIC_API_URL

export async function fetchPrivateGallery(
  token: string
): Promise<ShootingGalleryDto> {

  const response = await fetch(
    `${API_URL}/api/gallery/${token}`,
    {
      cache: 'no-store',
    }
  )

  if (!response.ok) {
    throw new Error('Failed to fetch gallery')
  }

  return response.json()
}