import { Navbar, Hero, About, Footer } from '@/components'
import '../app/globals.css';

export default function Home() {
  return (
    <>
    {/* <div className='absolute flex-row top-0 left-0 right-0 bottom-0 w-[100%] h-[100%] bg-white/10 z-[2]'/>  */}
    <main className="overflow-hidden custom-img bg-fixed bg-center bg-cover">
      <Navbar />
      <Hero />
      <About message='Vous voulez en voir plus sur mon travail ?'/>
      <Footer />
    </main>
    </>
  )
}
