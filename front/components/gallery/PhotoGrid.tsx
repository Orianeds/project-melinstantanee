'use client'

import { useState } from 'react'

import {
  SimpleGrid,
  Image,
  Box,
  AspectRatio,
} from '@chakra-ui/react'

import PhotoLightbox from './PhotoLightbox'
import { PhotoGridProps } from '@/dto/gallery/photo-grid.types'

export default function PhotoGrid({
  photos,
}: PhotoGridProps) {
  const [selectedIndex, setSelectedIndex] = useState<number | null>(null)

  return (
    <>
      <SimpleGrid
        columns={{
          base: 1,
          sm: 2,
          md: 3,
        }}
        spacing={4}
      >
        {photos.map((photo, index) => (
            <Box
                key={photo.id}
                overflow="hidden"
                borderRadius="lg"
                cursor="pointer"
                onClick={() => setSelectedIndex(index)}
            >
                <AspectRatio ratio={4 / 5}>
                    <Image
                    src={photo.imageUrl}
                    alt={photo.title ?? 'Photo'}
                    objectFit="cover"
                    width="100%"
                    height="100%"
                    transition="0.3s"
                    _hover={{
                        transform: 'scale(1.03)',
                    }}
                    />
                </AspectRatio>
            </Box>
        ))}
      </SimpleGrid>

      <PhotoLightbox
        photos={photos}
        isOpen={selectedIndex !== null}
        currentIndex={selectedIndex ?? 0}
        onClose={() => setSelectedIndex(null)}
      />
    </>
  )
}