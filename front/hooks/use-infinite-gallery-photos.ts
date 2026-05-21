'use client'

import { useEffect, useState, useCallback } from 'react'

import { PhotoDto } from '@/dto/gallery/photo.dto'
import { fetchGalleryPhotos } from '@/services/gallery/gallery.service'

export function useInfiniteGalleryPhotos(shootingId: number) {
  const [photos, setPhotos] = useState<PhotoDto[]>([])
  const [page, setPage] = useState(1)

  const [hasMore, setHasMore] = useState(true)
  const [loading, setLoading] = useState(false)
  const [error, setError] = useState<string | null>(null)

  const loadMore = useCallback(async () => {
    if (loading || !hasMore) return

    try {
      setLoading(true)

      const result = await fetchGalleryPhotos(
        shootingId,
        page,
        20
      )

      setPhotos((prev) => {
        const updated = [...prev, ...result.data]

        setHasMore(updated.length < result.total)

        return updated
      })

      setPage((prev) => prev + 1)
    } catch (err) {
      setError('Erreur lors du chargement des photos')
    } finally {
      setLoading(false)
    }
  }, [shootingId, page, loading, hasMore])

  useEffect(() => {
    loadMore()
  }, [loadMore])

  return {
    photos,
    loading,
    error,
    hasMore,
    loadMore,
  }
}