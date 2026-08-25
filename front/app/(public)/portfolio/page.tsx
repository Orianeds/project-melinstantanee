'use client'

import PhotoGrid from '@/components/gallery/PhotoGrid'

const photos = [
  {
    id: 1,
    imageUrl: 'https://picsum.photos/600/800?1',
    title: 'Mariage',
  },
  {
    id: 2,
    imageUrl: 'https://picsum.photos/600/800?2',
    title: 'Portrait',
  },
  {
    id: 3,
    imageUrl: 'https://picsum.photos/600/800?3',
    title: 'Famille',
  },
]

export default function PortfolioPage() {
  return (
    <PhotoGrid photos={photos} />
  )
}

// import React from 'react'
// import { Navbar, Footer, Portfolios} from '@/components'

// export default function portfolio () {
//   return (
//     <>
//     <Navbar />
//     <Portfolios />
//     <Footer />
//     </>
//   )
// }