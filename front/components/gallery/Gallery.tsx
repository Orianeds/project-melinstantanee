'use client'

import Image from 'next/image'
import { useEffect, useRef } from 'react'

import { useInfiniteGalleryPhotos } from '@/hooks/use-infinite-gallery-photos'

export function Gallery() {
  const {
    photos,
    loading,
    hasMore,
    loadMore,
  } = useInfiniteGalleryPhotos(1)

  const loaderRef = useRef<HTMLDivElement | null>(null)

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        const first = entries[0]

        if (first.isIntersecting && hasMore) {
          loadMore()
        }
      },
      {
        threshold: 1,
      }
    )

    const current = loaderRef.current

    if (current) {
      observer.observe(current)
    }

    return () => {
      if (current) {
        observer.unobserve(current)
      }
    }
  }, [hasMore, loadMore])

  return (
    <>
      <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
        {photos.map((photo) => (
          <div
            key={photo.id}
            className="relative aspect-[3/4] overflow-hidden rounded-xl"
          >
            <Image
              src={photo.imageUrl}
              alt=""
              fill
              sizes="(max-width: 768px) 50vw, 33vw"
              className="object-cover"
            />
          </div>
        ))}
      </div>

      <div ref={loaderRef} className="h-10" />

      {loading && (
        <p className="text-center py-4">
          Chargement...
        </p>
      )}
    </>
  )
}