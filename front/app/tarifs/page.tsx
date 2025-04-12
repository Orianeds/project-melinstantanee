import React from 'react'
import { Navbar, Footer, NewbornPrice, PortraitPrice, FamilyPrice, PregnancyPrice, CouplePrice } from '@/components'
import '../globals.css'


export default function tarifs () {
  return (
    <>
    <main className="overflow-hidden custom-img bg-fixed bg-center bg-cover">
    <Navbar />
    <NewbornPrice />
    <PortraitPrice />
    <FamilyPrice />
    <PortraitPrice />
    <PregnancyPrice />
    <CouplePrice />
    <Footer />
    </main>
    </>
  )
}